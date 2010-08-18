<?php

    $widget = $vars['widget'];

    echo view_layout('section', __("org:mission"), $widget->renderContent());

    $org = $vars['widget']->getContainerEntity();

    echo "<div class='section_header'>".__("widget:news:latest")."</div>";

    $items = $org->queryFeedItems()->limit(6)->filter();

    echo "<div class='section_content'>";

    echo view('feed/self_list', array('items' => $items));

    echo "</div>";

    $sectors = $org->getSectors();

    if (!empty($sectors))
    {
        echo view_layout('section', __("org:sectors"),
            view("org/sectors", array('sectors' => $sectors, 'sector_other' => $org->sector_other))
        );
    }

    ob_start();
        $zoom = $widget->zoom ?: 10;

        $lat = $org->getLatitude();
        $long = $org->getLongitude();
        echo view("org/map", array(
            'lat' => $lat,
            'long' => $long,
            'zoom' => $zoom,
            'pin' => true,
            'static' => true
        ));
        echo "<div style='text-align:center'>";
        echo "<em>";
        echo escape($org->getLocationText());
        echo "</em>";
        echo "<br />";
        echo "<a href='org/browse/?lat=$lat&long=$long&zoom=10'>";
        echo __('org:see_nearby');
        echo "</a>";
        echo "</div>";
    $map = ob_get_clean();
    echo view_layout('section', __("org:location"), $map);

?>
