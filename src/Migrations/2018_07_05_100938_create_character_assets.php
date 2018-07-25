<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('eve-sso.database');
        if (!Schema::connection($connection)->hasTable('character_assets')) {
            Schema::connection($connection)->create('character_assets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('character_id');
                $table->boolean('is_blueprint_copy')->nullable();
                $table->boolean('is_singleton');
                $table->bigInteger('item_id');
                //$table->string('location_flag');
                $table->enum('location_flag', 
                    [ 
                        'AssetSafety', 
                        'AutoFit', 
                        'BoosterBay', 
                        'Cargo', 
                        'CorpseBay', 
                        'Deliveries', 
                        'DroneBay', 
                        'FighterBay', 
                        'FighterTube0', 
                        'FighterTube1', 
                        'FighterTube2', 
                        'FighterTube3', 
                        'FighterTube4', 
                        'FleetHangar', 
                        'Hangar', 
                        'HangarAll', 
                        'HiSlot0', 
                        'HiSlot1', 
                        'HiSlot2', 
                        'HiSlot3', 
                        'HiSlot4', 
                        'HiSlot5', 
                        'HiSlot6', 
                        'HiSlot7', 
                        'HiddenModifiers', 
                        'Implant', 
                        'LoSlot0', 
                        'LoSlot1', 
                        'LoSlot2', 
                        'LoSlot3', 
                        'LoSlot4', 
                        'LoSlot5', 
                        'LoSlot6', 
                        'LoSlot7', 
                        'Locked', 
                        'MedSlot0', 
                        'MedSlot1', 
                        'MedSlot2', 
                        'MedSlot3', 
                        'MedSlot4', 
                        'MedSlot5', 
                        'MedSlot6', 
                        'MedSlot7', 
                        'QuafeBay', 
                        'RigSlot0', 
                        'RigSlot1', 
                        'RigSlot2', 
                        'RigSlot3', 
                        'RigSlot4', 
                        'RigSlot5', 
                        'RigSlot6', 
                        'RigSlot7', 
                        'ShipHangar', 
                        'Skill', 
                        'SpecializedAmmoHold', 
                        'SpecializedCommandCenterHold', 
                        'SpecializedFuelBay', 
                        'SpecializedGasHold', 
                        'SpecializedIndustrialShipHold', 
                        'SpecializedLargeShipHold', 
                        'SpecializedMaterialBay', 
                        'SpecializedMediumShipHold', 
                        'SpecializedMineralHold', 
                        'SpecializedOreHold', 
                        'SpecializedPlanetaryCommoditiesHold', 
                        'SpecializedSalvageHold', 
                        'SpecializedShipHold', 
                        'SpecializedSmallShipHold', 
                        'SubSystemBay', 
                        'SubSystemSlot0', 
                        'SubSystemSlot1', 
                        'SubSystemSlot2', 
                        'SubSystemSlot3', 
                        'SubSystemSlot4', 
                        'SubSystemSlot5', 
                        'SubSystemSlot6', 
                        'SubSystemSlot7', 
                        'Unlocked', 
                        'Wardrobe' 
                    ]);
                $table->bigInteger('location_id');
                $table->enum('location_type', 
                    [
                        'station', 
                        'solar_system',
                        'other'
                    ]);
                $table->integer('quantity');
                $table->integer('type_id');
                $table->string('item_name')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('eve-sso.database');
        $main = config('eve-sso.main_host');
        if ($main && Schema::connection($connection)->hasTable('character_assets')) {
            Schema::connection($connection)->dropIfExists('character_assets');
        }
    }
}
