<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //hàm dung để xử lý
        $words = [
            'ngot ngao' => 'Em hãy tin rằng, khi anh nhắn tin vào buổi sáng chỉ có thể là lời chúc ngọt ngào: Ngày mới rạng rỡ và niềm tin em nhé!',
            'lang man' => 'Mặt trời đã mọc! hãy thức giấc đi em. Chào buổi sáng!',
            'say dam' => 'Anh gửi cho em những cái ôm và nụ hôn của tình yêu trong tin nhắn chúc buổi sáng này và chúc em có một ngày tuyệt vời!',
            'xao' => 'Tối qua anh đi ngủ với một nụ cười vì anh biết anh sẽ mơ thấy em…Và sáng nay anh thức dậy cũng với một nụ cười vì anh biết em không phải là một giấc mơ',
            'vui ve' => 'Chúc cho cả ngày may mắn, niềm vui nối tiếp niềm vui, còn nỗi buồn thì ở lại…! Good morning!',
        ];

        $key = array_rand($words);
        $value = $words[$key];

        $users = User::all();
        foreach ($users as $user) {
            Mail::raw("{$key} -> {$value}", function ($mail) use ($user) {
                $mail->from('huy.miichisoft@gmail.com');
                $mail->to($user->email)
                    ->subject('Word of the Day');//chu de cho main
            });
        }

        $this->info('Word of the Day sent to All Users');
    }
}
