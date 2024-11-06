<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class DeleteExpiredTokens extends Command
{
    protected $signature = 'tokens:delete-expired';

    protected $description = 'Deletes expired tokens from email_o_t_p_tokens table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Calculate the time 24 hours ago
        $twentyFourHoursAgo = Carbon::now()->subHours(24);

        // Delete expired tokens
        DB::table('email_o_t_p_tokens')->where('created_at', '<', $twentyFourHoursAgo)->delete();

        $this->info('Expired tokens deleted successfully.');
    }
}
