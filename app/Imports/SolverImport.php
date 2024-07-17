<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Solver;
use Session;

class SolverImport implements ToCollection, WithMultipleSheets
{
    /**
    * @param Collection $collection
    */

    public function sheets(): array
    {
        return [
            1 => $this
        ];
    }

    public function collection(Collection $collection)
    {
        // dd($collection);
        $find_solver = Solver::where('user_id', Session::get('loginId'))->first();
        $data['user_id'] = Session::get('loginId');
        $data['profil_id'] = Session::get('profilId');
        
        foreach($collection as $key=>$row) {
            // Best
            if($key == 7) {
                $data['best'] = $row[2];
            }

            // Worst
            if($key == 9) {
                $data['worst'] = $row[2];
            }

            // Best to Others
            if($key == 12) {
                $data['best_to_c1'] = $row[2];
                $data['best_to_c2'] = $row[3];
                $data['best_to_c3'] = $row[4];
                $data['best_to_c4'] = $row[5];
            }

            // Others to the Worst
            if($key == 15) {
                $data['c1_to_worst'] = $row[2];
            }
            if($key == 16) {
                $data['c2_to_worst'] = $row[2];
            }
            if($key == 17) {
                $data['c3_to_worst'] = $row[2];
            }
            if($key == 18) {
                $data['c4_to_worst'] = $row[2];
            }

            // Weight
            if($key == 22) {
                $data['weight_c1'] = $row[2];
                $data['weight_c2'] = $row[3];
                $data['weight_c3'] = $row[4];
                $data['weight_c4'] = $row[5];
            }

            // Ksi
            if($key == 24) {
                $data['ksi'] = $row[2];
            }
        }
        // dd($data);

        if(isset($find_solver)) {
            $solver = Solver::find($find_solver->solver_id);
            $solver->update($data);
        } else {
            Solver::create($data);
        }
    }
}
