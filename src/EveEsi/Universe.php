<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveSSO\EveSSO;
use EveEsi\Scopes;

use EveSSO\Exceptions\InvalidScopeException;

use Carbon\Carbon;
use EveSSO\Structures;

class Universe extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    public function __construct(Esi $e) {
        parent::__construct();
        $this->esi = $e;
    }

    public function getInvType(int $type_id) {
        $uri = sprintf('universe/types/%s/', $type_id);

        if (!$this->commit_data) {
            
            return $this->esi->callEsi($uri, []);
        }

        //First lets see if we have it already
        $type = InvTypes::whereTypeId($type_id)->first();

        if ($type != null) {
            return $type;
        }
        
        // Lets get the item from Eve-online
        $eve_type = $this->esi->callEsi($uri, []);

        return InvTypes::updateOrCreate(['type_id' => $type_id], $eve_type);
    }

    public function getStructure($structure_id) {
        $uri = sprintf('universe/structures/%s/', $structure_id);

        if (!$this->commit_data) {
            
            return $this->esi->callEsi($uri, []);
        }

        //First lets see if we have it already
        $type = Structure::whereStructureId($structure_id)->first();

        if ($structure != null) {
            return $structure;
        }
        
        // Lets get the item from Eve-online
        $eve_structure = $this->esi->callEsi($uri, []);

        $eve_structure['structure_id'] = $structure_id;

        return Structure::updateOrCreate(['structure_id' => $structure_id], $eve_structure);
    }
}