<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class LoginController extends Controller
{
  /**
   * * ログインフォーム
   */
  public function index()
  {
    return view('login');
  }
  /**
   *  ログイン結果を表示
   *  @param  Request  $request
   *
   */

  public function result(Request $request)
  {
    $login_id = $request->input('login_id');
    $password = $request->input('password');
    // ログイン情報の確認
    //$exists = Account::where('login_id', $login_id)
    //->where('password', $password)
    //->exists();

    //DB::enableQueryLog();

    // 注意：脆弱性のあるコード(SQLインジェクション)
    $exists = DB::table('accounts')
      ->whereRaw('login_id = ?', [$login_id])
      ->whereRaw('password = ?', [$password])
      ->exists();

    //dd(DB::getQueryLog());

    if ($exists) {
      return "Login OK!";
    } else {
      return "Login NG!";
    }
  }
}
