<?php
/**
 * @file plugins/generic/optimetaCitations/classes/Install/OptimetaCitationsMigration.inc.php
 *
 * Copyright (c) 2021+ TIB Hannover
 * Copyright (c) 2021+ Gazi Yucel
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class OptimetaCitationsMigration
 * @ingroup plugins_generic_optimetacitations
 *
 * @brief Migrations
 */
namespace Optimeta\Citations\Install;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class OptimetaCitationsMigration extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        $this->createCitationsExtended();
    }

    public function createCitationsExtendedIfNotExists()
    {
        if (!Capsule::schema()->hasTable('citations_extended')) {
            $this->createCitationsExtended();
        }
    }

    private function createCitationsExtended()
    {
        Capsule::schema()->create('citations_extended', function (Blueprint $table) {
            $table->bigInteger('citations_extended_id')->nullable(0)->autoIncrement();
            $table->bigInteger('publication_id')->nullable(1);
            $table->longText('parsed_citations')->nullable(1);

            $table->index('publication_id');
        });

        /*
        // MySQL
        CREATE TABLE `citations_extended` (
         `citations_extended_id` bigint(20) NOT NULL AUTO_INCREMENT,
         `publication_id` bigint(20) DEFAULT NULL,
         `parsed_citations` longtext DEFAULT NULL,
         PRIMARY KEY (`citations_extended_id`),
         KEY `citations_extended_publication_id_index` (`publication_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
         */
    }
}
