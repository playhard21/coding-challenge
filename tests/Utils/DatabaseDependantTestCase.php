<?php

namespace Tests\Utils;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseDependantTestCase extends KernelTestCase
{
    /** @var EntityManagerInterface */
    protected EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        self::updateDBSchema($kernel);

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        //close the connection
        $this->entityManager->close();
    }

    public static function updateDBSchema(KernelInterface $kernel): void
    {
        // Make sure we are in the test environment
        if ('test' !== $kernel->getEnvironment()) {
            throw new \LogicException('Must be executed in the test environment');
        }

        // Get the entity manager from the service container
        $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        // Run the schema update tool using our entity metadata
        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->updateSchema($metadatas);
    }

}
