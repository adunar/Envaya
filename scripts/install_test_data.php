<?php

/*
 * Installs test data required for selenium tests. Recommended for development computers,
 * not to be used on production servers.
 */

require_once "start.php";
require_once 'scripts/cmdline.php';

function main()
{   
    install_admin();
    
    $admin_email = Config::get('admin_email');
    
    for ($i = 0; $i < 22; $i++)
    {
        $org = install_org("testposter$i");        
        $org->phone_number = "cell: $i$i$i$i$i$i$i, fax: +124124129481";                        
        $org->name = "Test Poster$i";
        $org->email = str_replace('@',"+p$i@", $admin_email);
        $org->save();        
    }
    
    install_org('testorg');
    
    foreach (Config::get('modules') as $module)
    {
        $path = Engine::get_module_root($module)."/scripts/install_test_data.php";
        echo "$path\n";
        if (is_file($path))
        {
            require $path;
        }
    }
}

function install_admin()
{
    $admin = User::get_by_username('testadmin');
    if (!$admin)
    {
        $admin = new User();
        $admin->username = "testadmin";
        $admin->set_password('testtest');
        $admin->name = "Test Admin";
        $admin->email = Config::get('admin_email');
        $admin->admin = true;    
        $admin->save();
    }
}

function install_org($username)
{
    $org = Organization::query()->where('username = ?', $username)->get();
    if (!$org)
    {    
        $org = new Organization();
        $org->username = $username;
    }

    $org->email = Config::get('admin_email');
    $org->set_design_setting('theme_name', 'green');
    $org->set_design_setting('tagline', 'a test organization');
    $org->set_design_setting('share_links', array('email', 'facebook', 'twitter'));
    $org->name = "Test Org";
    $org->set_password('testtest');
    $org->language = 'en';
    $org->set_sectors(array(6,19));
    $org->country = 'tz';
    $org->setup_state = SetupState::CreatedHomePage;
    $org->set_lat_long(-6.140555,35.551758);
    $org->approval = 1;
    $org->save();
    
    $home = $org->get_widget_by_class('Home');
    $home->save();
            
    $home->get_widget_by_class('Mission')->save();        
    $home->get_widget_by_class('Updates')->save();        
    $home->get_widget_by_class('Sectors')->save();
    $home->get_widget_by_class('Location')->save();    
    
    $org->get_widget_by_class('News')->save();
    $org->get_widget_by_class('Contact')->save();
    
    return $org;
}
    
main();
 
Config::set('debug', false);

print "done";