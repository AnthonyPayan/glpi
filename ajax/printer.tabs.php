<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2011 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!isset($_POST["id"])) {
   $_POST["id"] = "";
}
if (!isset($_POST["sort"])) {
   $_POST["sort"] = "";
}
if (!isset($_POST["order"])) {
   $_POST["order"] = "";
}
if (!isset($_POST["withtemplate"])) {
   $_POST["withtemplate"] = "";
}

checkRight("printer","r");

$printer = new Printer();

if ($_POST["id"]>0 && $printer->can($_POST["id"],'r')) {

   if (!empty($_POST["withtemplate"])) {
      switch($_REQUEST['glpi_tab']) {
         case 3 :
            NetworkPort::showForItem($printer, $_POST["withtemplate"]);
            break;

         default :
            CommonGLPI::displayStandardTab($printer, $_REQUEST['glpi_tab'], $_POST["withtemplate"]);
      }

   } else {
      switch($_REQUEST['glpi_tab']) {
         case -1 :
            Cartridge::showInstalled($printer);
            Cartridge::showInstalled($printer, 1);
            Computer_Item::showForItem($printer);
            NetworkPort::showForItem($printer);
            Infocom::showForItem($printer);
            Contract::showAssociated($printer);
            Document::showAssociated($printer);
            Ticket::showListForItem($printer);
            Link::showForItem($printer);
            Plugin::displayAction($printer, $_REQUEST['glpi_tab']);
            break;

         case 3 :
            Computer_Item::showForItem($printer);
            NetworkPort::showForItem($printer);
            break;

         default :
            if (!CommonGLPI::displayStandardTab($printer, $_REQUEST['glpi_tab'])) {
               Cartridge::showInstalled($printer);
               Cartridge::showInstalled($printer, 1);
            }
      }
   }
}

ajaxFooter();

?>
