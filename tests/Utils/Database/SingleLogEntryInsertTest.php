<?php

namespace Tests\Utils\Database;

use App\Entity\Logs;
use App\Entity\LogRequest;
use App\Entity\LogDates;
use Tests\Utils\DatabaseDependantTestCase;

class SingleLogEntryInsertTest extends DatabaseDependantTestCase
{
    /** @test */
    public function a_log_record_can_be_created_in_the_database()
    {
        // Get the tables
        $logsTable = new Logs();
        $logDate = new LogDates();
        $logRequest = new LogRequest();

        // append sample data to log_date table
        $date = new \DateTime('09/Aug/2020:11:33:59 +0300');
        $logDate->setDate($date);
        $logDate->setOffset('+0300');
        $logDate->setDateUtc($date->setTimezone(new \DateTimeZone('UTC')));

        // append sample data to log_request table
        $logRequest->setType('GET');
        $logRequest->setEndPoint('/users');
        $logRequest->setProtocol('HTTP/1.1');


        // append sample data to log table
        $logsTable->setDateId($logDate);
        $logsTable->setRequestId($logRequest);
        $logsTable->setServiceNames('USER-SERVICE');
        $logsTable->setStatusCode(201);

        //save the data
        $this->entityManager->persist($logDate);
        $this->entityManager->persist($logRequest);
        $this->entityManager->persist($logsTable);
        $this->entityManager->flush();

        //Get the saved log_id
        $logId = $logsTable->getId();

        $logsRepository = $this->entityManager->getRepository(Logs::class);

        $logRecord = $logsRepository->find($logId);

        // Assertions
        $this->assertEquals('USER-SERVICE', $logRecord->getServiceNames());
        $this->assertEquals(201, $logRecord->getStatusCode());
    }

}
