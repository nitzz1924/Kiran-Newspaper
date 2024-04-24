<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
namespace App\Http\Controllers;

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
        $data = Date::orderBy('date','desc')->get();
        // dd($data);
        return view('AdminPanel.allnewspapers',compact('data'));
    }

    public function paperdetailsview($id)
    {
        $newspaperdata = Newspaper::where('newsid',$id)->get();
        $data = Date::find($id);
        return view('AdminPanel.paperdetails',compact('newspaperdata','data'));
    }

    public function homepage()
    {
        $data = Date::orderBy('date','desc')->get();
        return view('home',compact('data'));
    }

    public function viewnews($id)
    {
        $newspaperdata = Newspaper::where('newsid',$id)->get();
        $data = Date::find($id);
        return view('viewnews',compact('newspaperdata','data'));
    }
}
