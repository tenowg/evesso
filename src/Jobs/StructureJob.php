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

class StructureJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    protected $structure_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $structure_id)
    {
        $this->structure_id = $structure_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Universe $esi)
    {
        $esi->getStructure($this->structure_id);
    }
}
