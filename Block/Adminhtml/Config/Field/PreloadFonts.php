<?php

namespace Wage\Preload\Block\Adminhtml\Config\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class PreloadFonts extends AbstractFieldArray
{
    /**
     * @inheritdoc
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'css_class',
            [
                'label'    => __('Font URLs'),
                'renderer' => false,
                'class'    => ''
            ]
        );

        $this->_addAfter       = false;
        $this->_addButtonLabel = __('Add');
    }
}
