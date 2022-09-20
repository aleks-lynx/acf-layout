<?php
namespace OffbeatWP\AcfLayout\Components\Row;

use OffbeatWP\Components\AbstractComponent;

class Row extends AbstractComponent
{
    public function render($settings)
    {
        $rowContent = $settings->rowContent;
        unset($settings->rowContent);

        $variations = self::variations();
        $variation  = isset($settings->width) ? $settings->width : '';

        if (empty($variation) || !isset($variations[$variation])) {
            $variation = 'default';
        }

        $rowTheme      = offbeat('design')->getRowThemeClasses($settings->row_theme);
        $marginTop     = offbeat('design')->getMarginClasses($settings->margin_top, 'row', 'mt');
        $marginBottom  = offbeat('design')->getMarginClasses($settings->margin_bottom, 'row', 'mb');
        $paddingTop    = offbeat('design')->getPaddingClasses($settings->padding_top, 'row', 'pt');
        $paddingBottom = offbeat('design')->getPaddingClasses($settings->padding_bottom, 'row', 'pb');

        $rowId                = isset($settings->id) || empty($settings->id) ? $settings->id : null;
        $additionalRowClasses = isset($settings->css_classes) ? $settings->css_classes : null;

        $rowClasses = implode(' ', compact('rowTheme', 'marginTop', 'marginBottom', 'paddingTop', 'paddingBottom'));

        if (!empty($additionalRowClasses)) {
            $rowClasses .= " {$additionalRowClasses}";
        }

        return $this->view($variation, [
            'rowContent' => $rowContent,
            'rowClasses' => $rowClasses,
            'rowId'      => $rowId,
            'settings'   => $settings,
        ]);
    }

    public static function variations()
    {
        return [
            'default'    => [
                'label' => __('Default', 'offbeatwp'),
            ],
        ];
    }

    static function settings() {
        return [];
    }
}
