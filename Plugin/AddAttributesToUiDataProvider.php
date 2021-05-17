<?php 

namespace SMP\Grid\Plugin;

use SMP\Grid\Ui\DataProvider\ListingDataProvider;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider {   

    public function afterGetSearchResult(ListingDataProvider $subject,SearchResult $result) {
        $result->addFieldToFilter('pid', ['eq' => 0]);
        return $result;
    }
    
}