<?php

namespace App\Entity;

use App\Repository\LogRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRequestRepository::class)]
class LogRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $end_point = null;

    #[ORM\Column(length: 255)]
    private ?string $protocol = null;

    #[ORM\OneToOne(mappedBy: 'request_id', cascade: ['persist', 'remove'])]
    private ?Logs $logs_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEndPoint(): ?string
    {
        return $this->end_point;
    }

    public function setEndPoint(string $end_point): self
    {
        $this->end_point = $end_point;

        return $this;
    }

    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function getLogsId(): ?Logs
    {
        return $this->logs_id;
    }

    public function setLogsId(Logs $logs_id): self
    {
        // set the owning side of the relation if necessary
        if ($logs_id->getRequestId() !== $this) {
            $logs_id->setRequestId($this);
        }

        $this->logs_id = $logs_id;

        return $this;
    }
}
