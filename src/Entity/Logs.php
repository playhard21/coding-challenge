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
    private ?LogDates $date = null;

    #[ORM\OneToOne(inversedBy: 'logs_id', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?LogRequest $request = null;

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
        return $this->date;
    }

    public function setDateId(LogDates $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRequestId(): ?LogRequest
    {
        return $this->request;
    }

    public function setRequestId(LogRequest $request): self
    {
        $this->request = $request;

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
