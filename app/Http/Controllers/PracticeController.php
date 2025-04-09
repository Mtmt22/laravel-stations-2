<?PHP

namespace App\Http\Controllers;

class PracticeController extends Controller
{
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
