<?php

namespace App\Entity;

use App\Repository\LogDatesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogDatesRepository::class)]
class LogDates
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?string $offset = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_utc = null;

    #[ORM\OneToOne(mappedBy: 'date_id', cascade: ['persist', 'remove'])]
    private ?Logs $logs_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(string $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function getDateUtc(): ?\DateTimeInterface
    {
        return $this->date_utc;
    }

    public function setDateUtc(\DateTimeInterface $date_utc): self
    {
        $this->date_utc = $date_utc;

        return $this;
    }

    public function getLogsId(): ?Logs
    {
        return $this->logs_id;
    }

    public function setLogsId(Logs $logs_id): self
    {
        // set the owning side of the relation if necessary
        if ($logs_id->getDateId() !== $this) {
            $logs_id->setDateId($this);
        }

        $this->logs_id = $logs_id;

        return $this;
    }
}
