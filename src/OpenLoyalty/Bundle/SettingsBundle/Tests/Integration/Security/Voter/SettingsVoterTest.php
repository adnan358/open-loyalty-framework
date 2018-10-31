<?php

namespace OpenLoyalty\Bundle\SettingsBundle\Tests\Integration\Security\Voter;

use OpenLoyalty\Bundle\CoreBundle\Tests\Integration\BaseVoterTest;
use OpenLoyalty\Bundle\SettingsBundle\Security\Voter\SettingsVoter;

/**
 * Class SettingsVoterTest.
 */
class SettingsVoterTest extends BaseVoterTest
{
    /**
     * @test
     */
    public function it_works()
    {
        $attributes = [
            SettingsVoter::VIEW_SETTINGS => ['seller' => false, 'customer' => false, 'admin' => true],
            SettingsVoter::VIEW_SETTINGS_CHOICES => ['seller' => true, 'customer' => true, 'admin' => true],
            SettingsVoter::EDIT_SETTINGS => ['seller' => false, 'customer' => false, 'admin' => true],
        ];

        $voter = new SettingsVoter();

        $this->assertVoterAttributes($voter, $attributes);
    }

    protected function getSubjectById($id)
    {
        return;
    }
}
