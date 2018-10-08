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

class CharacterAssetNames implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EveSSO
     */
    protected $asset;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $asset)
    {
        $this->asset = $asset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Assets $char_esi)
    {
        $ids = [];
        foreach($this->asset as $asset) {
            array_push($ids, $asset->item_id);
        }
        $names = $char_esi->getAssetNames($this->asset[0]->sso, $ids);

        foreach($names as $name) {
            if ($name['name'] !== 'None') {
                CharacterAssets::whereItemId($name['item_id'])->update(['item_name' => $name['name']]);
            }
        }
    }
}
