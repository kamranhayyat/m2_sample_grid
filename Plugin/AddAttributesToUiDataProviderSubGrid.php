<?php 

namespace SMP\Grid\Plugin;

use SMP\Grid\Ui\DataProvider\ListingDataProviderSubGrid;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProviderSubGrid {   

    public function afterGetSearchResult(ListingDataProviderSubGrid $subject,SearchResult $result) {
        $result->addFieldToFilter('pid', ['gt' => 0]);
        return $result;
    }
    
}