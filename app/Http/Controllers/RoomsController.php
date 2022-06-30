<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoomsController extends Controller
{
    // middleware to check if user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add_rooms(Request $request){
        $rooms = Room::paginate(15);

        //get last room id
        $last_room_id = Room::orderBy('id', 'desc')->first();
        // dd($last_room_id->id);
        $last_room_id = $last_room_id !== null ? $last_room_id->id : 0;
        if($request->isMethod('post')){
            $request->validate([
                'rooms' => 'required',
                'price' => 'required',
            ]);

           try{
                //save list of room to table rooms depending on the number of $request->no_of_rooms entered, if $request->no_of_rooms is 10 , save 10 rooms to database
                for ($i = $last_room_id; $i < number_format($request->rooms) + $last_room_id;) {
                    $room = new Room();
                    $room->name = 'Room' . ' ' . $i + 1;
                    $room->price = $request->price;
                    $room->status = 'available';
                    $saved1 = $room->save();
                    $i++;
                }

                return redirect()->route('rooms')->with('success', 'Rooms added successfully');

           } catch (\Exception $e) {
                Alert::error('Error', 'Failed to add rooms');
                return back()->with('error', 'Failed to add rooms');
           }
        
        }
        if(count($rooms) < 1){
            Alert::warning('Warning', 'No rooms available, please add rooms');
        }
        
        return view('add_rooms');
    }


    public function rooms_list(){
        $rooms = Room::paginate(10);
        return view('rooms', ['rooms' => $rooms]);
    }


    public function edit_room(Request $request, $id){
        $room = Room::find(base64_decode($id));
        // dd($room);

        if($request->isMethod('post')){
        //    dd($request->all());
         
            try{
                $room = Room::where('id', $id)->first()->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'status' => $request->status,
                ]);
            
                if ($room) {
                    return redirect()->route('rooms')->with('success', 'Room updated successfully');
                } else {
                    return redirect()->route('rooms')->with('error', 'Failed to update room');
                }
            } catch (\Exception $e) {
                Alert::error('Error', 'Failed to update room');
                return back()->with('error', 'Failed to update room');
            }
            
        }
        return view('edit_room', ['room' => $room]);
    }

    // Delete room
    public function delete_room($id){
        $room = Room::find(base64_decode($id));
        if($room->status == 'booked'){
            return redirect()->route('rooms')->with('error', 'Room is already booked, cannot delete');  //if room is booked, cannot delete
        }
        $deleted = $room->delete();
        if ($deleted) {
            return redirect()->route('rooms')->with('success', 'Room deleted successfully');
        } else {
            return redirect()->route('rooms')->with('error', 'Failed to delete room');
        }
    }

}
