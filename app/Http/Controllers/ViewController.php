<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
namespace App\Http\Controllers;

use App\Models\Mapping;
use App\Models\Newspaper;
use App\Models\Date;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewaddnews()
    {
        return view('AdminPanel.addnewspaper');
    }
    public function allnewspapers()
    {
        $data = Date::orderBy('date', 'desc')->get();
        // dd($data);
        return view('AdminPanel.allnewspapers', compact('data'));
    }

    public function paperdetailsview($id)
    {
        $newspaperdata = Newspaper::where('newsid', $id)->get();
        $data = Date::find($id);
        $mappingdata = Mapping::where('newspaperid',$id)->get();
        return view('AdminPanel.paperdetails', compact('newspaperdata', 'data','mappingdata'));
    }

    public function homepage()
    {
        $data = Date::orderBy('date', 'desc')->paginate(6);
        return view('home', compact('data'));
    }

    public function viewnews($id, $date)
    {
        $newspaperdata = Newspaper::where('newsid', $id)->get();
        $data = Date::find($id);
        return view('viewnews', compact('newspaperdata', 'data'));
    }

    public function daterecords($selectedDate)
    {
        try {
            $dates = Date::whereDate('date', $selectedDate)->get();
            // dd($dates);
            return response()->json($dates);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
