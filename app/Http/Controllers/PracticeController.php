<?PHP

namespace App\Http\Controllers;

use App\Practice;

class PracticeController extends Controller
{
  // 04 データベースからの情報を取得する
  public function getPractice() {
    // データベースから全件取得
    $practice = Practice::all();
    // jsonとして返す
    return response()->json($practice);
  }


  // 03 HTMLを返すように変更
  public function sample() {
    return view('practice');
  }

  public function sample2() {
    $test = 'practice2';
    return view('practice2', ['testParam' => $test]);
  }

  public function sample3() {
    $name = 'test';
    return view('practice3', ['testParam' => $name]);
  }


  // 02 public function index(){}の塊を メソッド と呼ぶ
  // public function sample() {
  //   return response('practice');
  // }

  // public function sample2() {
  //   $name = 'practice2';
  //   return response($name);
  // }

  // public function sample3() {
  //   $name = 'test';
  //   return response($name);
  // }
}
