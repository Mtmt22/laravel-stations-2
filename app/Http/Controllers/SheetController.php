<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function indexSheet() {
      // 全データを取得する
      $sheets = Sheet::all();
      return view('sheets', compact('sheets'));
    }
}
