<?php
/*
 * Copyright © 2018 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Bundle\UserBundle\Tests\Integration\Security\Voter;

use OpenLoyalty\Bundle\CoreBundle\Tests\Integration\BaseVoterTest;
use OpenLoyalty\Bundle\SettingsBundle\Service\SettingsManager;
use OpenLoyalty\Bundle\UserBundle\Security\Voter\CustomerVoter;
use OpenLoyalty\Component\Customer\Domain\CustomerId;
use OpenLoyalty\Component\Customer\Domain\ReadModel\CustomerDetails;
use OpenLoyalty\Component\Seller\Domain\ReadModel\SellerDetailsRepository;

/**
 * Class CustomerVoterTest.
 */
class CustomerVoterTest extends BaseVoterTest
{
    const CUSTOMER_ID = '00000000-0000-474c-b092-b0dd880c0700';
    const CUSTOMER2_ID = '00000000-0000-474c-b092-b0dd880c0701';
    const POS_ID = '00000000-0000-474c-b092-b0dd880c0711';
    const POS2_ID = '00000000-0000-474c-b092-b0dd880c1711';

    /**
     * @test
     */
    public function it_works(): void
    {
        $attributes = [
            CustomerVoter::CREATE_CUSTOMER => ['seller' => true, 'customer' => false, 'admin' => true],
            CustomerVoter::LIST_CUSTOMERS => ['seller' => true, 'customer' => false, 'admin' => true],
            CustomerVoter::ASSIGN_POS => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
            CustomerVoter::ASSIGN_CUSTOMER_LEVEL => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
            CustomerVoter::DEACTIVATE => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
            CustomerVoter::VIEW => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
            CustomerVoter::VIEW_STATUS => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
            CustomerVoter::EDIT => ['seller' => true, 'customer' => false, 'admin' => true, 'id' => self::CUSTOMER_ID],
        ];

        /** @var SellerDetailsRepository|\PHPUnit_Framework_MockObject_MockObject $sellerDetailsRepositoryMock */
        $sellerDetailsRepositoryMock = $this->getMockBuilder(SellerDetailsRepository::class)->getMock();
        $sellerDetailsRepositoryMock->method('find')->willReturn(null);

        /** @var SettingsManager|\PHPUnit_Framework_MockObject_MockObject $settingsManagerMock */
        $settingsManagerMock = $this->getMockBuilder(SettingsManager::class)->getMock();

        $voter = new CustomerVoter($sellerDetailsRepositoryMock, $settingsManagerMock);

        $this->assertVoterAttributes($voter, $attributes);
    }

    protected function getSubjectById($id)
    {
        $customer = $this->getMockBuilder(CustomerDetails::class)->disableOriginalConstructor()->getMock();
        $customer->method('getCustomerId')->willReturn(new CustomerId($id));

        return $customer;
    }
}
