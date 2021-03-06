<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Backend\Helper;

class DataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Backend\Helper\Data
     */
    protected $_helper;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_frontResolverMock;

    protected function setUp()
    {
        $this->_frontResolverMock = $this->getMock(
            '\Magento\Backend\App\Area\FrontNameResolver',
            array(),
            array(),
            '',
            false
        );
        $this->_helper = new \Magento\Backend\Helper\Data(
            $this->getMock('Magento\Framework\App\Helper\Context', array(), array(), '', false, false),
            $this->getMock('\Magento\Framework\App\Route\Config', array(), array(), '', false),
            $this->getMock('Magento\Framework\Locale\ResolverInterface'),
            $this->getMock('\Magento\Backend\Model\Url', array(), array(), '', false),
            $this->getMock('\Magento\Backend\Model\Auth', array(), array(), '', false),
            $this->_frontResolverMock,
            $this->getMock('\Magento\Framework\Math\Random', array(), array(), '', false),
            $this->getMock('\Magento\Framework\App\RequestInterface')
        );
    }

    public function testGetAreaFrontNameLocalConfigCustomFrontName()
    {
        $this->_frontResolverMock->expects(
            $this->once()
        )->method(
            'getFrontName'
        )->will(
            $this->returnValue('custom_backend')
        );

        $this->assertEquals('custom_backend', $this->_helper->getAreaFrontName());
    }
}
