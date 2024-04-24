<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
namespace App\Http\Controllers;

use App\Models\Newspaper;
use App\Models\Date;
use Illuminate\Http\Request;
use Exception;

class StoreController extends Controller
{
    public function createnewspaper(Request $req)
    {
        $sequence = $req->sequence;
        $papers = $req->papers;

        $date = Date::create([
            'date' => $req->newsdate,
        ]);

        $data_id = $date->id;
        // dd($data_id);
        try {
            $req->validate([
                'sequence.*' => 'required',
                'papers.*' => 'required',
            ]);
            $image = array();
                if ($files = $req->file('papers')) {
                    foreach ($files as $file) {
                        $image_name = md5(rand(1000, 10000));
                        $extension = strtolower($file->getClientOriginalExtension());
                        $image_fullname = $image_name . '.' . $extension;
                        $uploaded_path = "uploads/";    //for live server add 'public/uploads/'
                        $image_url = $uploaded_path . $image_fullname;
                        $file->move($uploaded_path, $image_fullname);
                        $image[] = $image_url;
                    }
                }
            for ($i = 0; $i < count($sequence); $i++) {
                $datasave = [
                    'sequence' => $sequence[$i],
                    'papers' => $image[$i],
                    'newsid' => $date->id,
                ];
                Newspaper::create($datasave);
            }
            return back()->with('success', 'Uploaded Successfully..!!!!');
        } catch (Exception $e) {
            //return redirect()->route('viewaddnews')->with('error', $e->getMessage());
            return redirect()->route('viewaddnews')->with('error', 'Not Created Try Again...');
        }

    }
}
