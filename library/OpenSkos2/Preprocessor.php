<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenSkos2;

use OpenSkos2\Rdf\ResourceManager;
use OpenSkos2\Rdf\Resource;
use OpenSkos2\Namespaces\OpenSkos;
use OpenSkos2\Namespaces\Skos;
use OpenSkos2\Api\Exception\ApiException;

require_once dirname(__FILE__) .'/config.inc.php';

class Preprocessor {
    
    private $manager;
    private $resourceType;
    private $userUri;
    
    function __construct(ResourceManager $resManager, $resourceType, $userUri) {
        $this->manager = $resManager;
        $this->resourceType = $resourceType;
        $this->userUri = $userUri;
    }

    public function forCreation(Resource $resourceObject, $params, $autoGenerateUuidUriWhenAbsent) {
        if ($this->resourceType === Skos::CONCEPT && !isset($params['seturi'])) {
            $params['seturi'] = $this->deriveSetUriForConcepts($resourceObject);
        }
        $preprocessed = $resourceObject;
        $preprocessed->addMetadata($this->userUri, $params, null);
        
        if ($this->resourceType === Skos::CONCEPT || $this->resourceType === Skos::CONCEPTSCHEME || $this->resourceType === Skos::SKOSCOLLECTION) {
          $sets = $preprocessed->getProperty(OpenSkos::SET);
          if (count($sets)<1) {
            throw new ApiException('The set (former known as tenant collection) of the resource is not given and cannot be derived', 400);
            }
        }
        
        if ($autoGenerateUuidUriWhenAbsent) {
            $params['type'] = $this->resourceType;     
            if ($this->resourceType === Skos::CONCEPT) {
                    $notations = $preprocessed->getProperty(Skos::NOTATION);
                    if (count($notations) === 0) {
                        $params['notation'] = null;
                    } else {
                        $params['notation'] = $notations[0];
                    }
            }
            $preprocessed->selfGenerateUuidAndUriWhenAbsent($this->manager, $params);
        };
        return $preprocessed;
    }
    
    
    

    public function forUpdate(Resource $resourceObject, $params) {
        if ($this->resourceType === Skos::CONCEPT && !isset($params['seturi'])) {
            $params['seturi'] = $this->deriveSetUriForConcepts($resourceObject);
        }
        $preprocessed = $resourceObject;
        $uri = $resourceObject->getUri();
        $existingResource = $this->manager->fetchByUri($uri, $this->resourceType);
        $preprocessed->addMetadata($this->userUri, $params, $existingResource);
        if ($this->manager->getResourceType() !== Relation::TYPE) { // we do not have an uuid for relations
            //var_dump($preprocessed->getUuid());
            //var_dump($existingResource->getUuid());
            if ($preprocessed->getUuid() !== null && $preprocessed->getUuid() !== $existingResource->getUuid()) {
                throw new ApiException('You cannot change UUID of the resouce. Keep it ' . $existingResource->getUuid(), 400);
            }
        }
        $preprocessed->addMetadata($this->userUri, $params, $existingResource);
        return $preprocessed;
    }

    private function deriveSetUriForConcepts($concept) {
        $sets = $concept->getProperty(OpenSkos::SET);
        if (count($sets) < 1) {
            $schemes = $concept->getProperty(Skos::INSCHEME);
            if (count($schemes) > 0) {
                $schemeuri = $schemes[0]->getUri();
                $scheme = $this->manager->fetchByUri($schemeuri, Skos::CONCEPTSCHEME);
                $schemesets = $scheme->getProperty(OpenSkos::SET);
                if (count($schemesets) > 0) {
                    return $schemesets[0]->getUri();
                }
            }
        } else {
            return $sets[0]->getUri();
        }
        return null;
    }

}
