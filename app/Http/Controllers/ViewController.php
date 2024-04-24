<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
namespace App\Http\Controllers;

use App\Models\Newspaper;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function viewaddnews()
    {
        return view('AdminPanel.addnewspaper');
    }
    public function allnewspapers()
    {
        $data = Newspaper::join('dates', 'newspapers.newsid','=','dates.id')->select('dates.*','newspapers.*')->first();
        // dd($data);
        return view('AdminPanel.allnewspapers',compact('data'));
    }
}
