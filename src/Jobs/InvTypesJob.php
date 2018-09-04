<?php

namespace EveSSO\Jobs;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveSSO\EveSSO;
use EveSSO\CharacterAssets;
use EveEsi\Assets;
use EveEsi\Universe;

class CharacterAssetNames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    protected $type_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Universe $esi)
    {
        $esi->getInvType($this->type_id);
    }
}
