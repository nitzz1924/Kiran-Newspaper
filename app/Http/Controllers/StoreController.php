<?php
#    || उद्यम से ही कार्य सिद्ध होते हैं, इच्छा से नहीं। सोते हुए शेर के मुँह में कोई भी मृग नहीं घुसता। ||
namespace App\Http\Controllers;

use App\Models\Mapping;
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

            $date = Date::create([
                'date' => $req->newsdate,
                'coverimage' => $image[0],
            ]);

            $data_id = $date->id;
            // dd($data_id);
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

    public function addmapping(Request $req)
    {
        // dd($req->all());
        try {
            $data = new Mapping();
            $data->xaxis = $req->xaxis;
            $data->yaxis = $req->yaxis;
            $data->bxaxis = $req->bxaxis;
            $data->byaxis = $req->byaxis;
            $data->newspaperid = $req->newspaperid;
            $data->paperid = $req->pageid;
            $data->croppedimg = $req->cropimghid;
            // dd($data);
            $data->save();
            $responseData = [
                'msg' => 'success',
                'data' => $data,
            ];
            return response()->json($responseData);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function finalmapping(Request $req)
    {
        $mappingdata = Mapping::where('paperid',$req->id)->get();
        return response()->json($mappingdata);
    }
}




