<?PHP

namespace App\Http\Controllers;

class PracticeController extends Controller
{
  // public function index(){}の塊を メソッド と呼ぶ
  public function sample()
  {
    return response('practice');
  }

  public function sample2()
  {
    $name = 'practice2';
    return response($name);
  }

  public function sample3()
  {
    $name = 'test';
    return response($name);
  }
}
