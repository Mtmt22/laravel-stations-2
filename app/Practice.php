<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Eloquentモデルとしてテーブルのデータを操作する窓口が Practice.php の役割
// デフォルトで practices というテーブルに自動的に対応する。
// モデル名を複数形にし、小文字にしてpracticesに変換させる（命名規則）
class Practice extends Model
{
    use HasFactory;

    // 他の名前のテーブルを使いたい場合の記述例
    // protected $table = 'custom_table_name';
}
