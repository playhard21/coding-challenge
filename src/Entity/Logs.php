<?php

namespace App\Entity;

use App\Repository\LogsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogsRepository::class)]
class Logs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $service_names = null;

    #[ORM\OneToOne(inversedBy: 'logs_id', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?LogDates $date_id = null;

    #[ORM\OneToOne(inversedBy: 'logs_id', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?LogRequest $request_id = null;

    #[ORM\Column]
    private ?int $status_code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceNames(): ?string
    {
        return $this->service_names;
    }

    public function setServiceNames(string $service_names): self
    {
        $this->service_names = $service_names;

        return $this;
    }

    public function getDateId(): ?LogDates
    {
        return $this->date_id;
    }

    public function setDateId(LogDates $date_id): self
    {
        $this->date_id = $date_id;

        return $this;
    }

    public function getRequestId(): ?LogRequest
    {
        return $this->request_id;
    }

    public function setRequestId(LogRequest $request_id): self
    {
        $this->request_id = $request_id;

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->status_code;
    }

    public function setStatusCode(int $status_code): self
    {
        $this->status_code = $status_code;

        return $this;
    }
}
