<?php

namespace POData\Writers;

use POData\Common\ODataException;
use POData\ObjectModel\ODataURL;
use POData\ObjectModel\ODataURLCollection;
use POData\ObjectModel\ODataFeed;
use POData\ObjectModel\ODataEntry;
use POData\ObjectModel\ODataLink;
use POData\ObjectModel\ODataPropertyContent;
use POData\ObjectModel\ODataProperty;
use POData\Providers\ProvidersWrapper;
use POData\Common\Version;

/**
 * Class IODataWriter
 * @package POData\Writers\Common
 */
interface IODataWriter
{

	/**
	 * Determines if the given writer is capable of writing the response or not
	 * @param Version $responseVersion the OData version of the response
	 * @param string $contentType the Content Type of the response
	 * @return boolean true if the writer can handle the response, false otherwise
	 */
	public function canHandle(Version $responseVersion, $contentType);

	/**
	 * Create OData object model from the request description and transform it to required content type form
	 *
	 *
	 * @param  ODataURL|ODataURLCollection|ODataPropertyContent|ODataFeed|ODataEntry $model Object of requested content.
	 *
	 * @return IODataWriter
	 */
	public function write($model);


    /**
     * @param ProvidersWrapper $providers
     * @return IODataWriter
     */
    public function writeServiceDocument(ProvidersWrapper $providers);

    /**
     * Get the output as string
     *  
     * @return string Result in requested format i.e. Atom or JSON.
     */
    public function getOutput();
}