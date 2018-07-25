<?php

namespace EveSSO\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveSSO\EveSSO;
use EveEsi\Character;

class CharacterPublic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EveSSO
     */
    protected $sso;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EveSSO $sso)
    {
        $this->sso = $sso;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Character $char_esi)
    {
        $char_esi->getCharacterPublic($this->sso);
    }
}
