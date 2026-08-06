# Architettura AWS 3-Tier Sicura ed ad Alta Affidabilità (HA)

## Descrizione del Progetto
In questo progetto è stata progettata e implementata un'infrastruttura cloud enterprise su **Amazon Web Services (AWS)** basata su un'architettura a tre livelli (**Presentation, Application e Data Tier**). 

L'obiettivo principale è stato creare un ambiente ad **Alta Affidabilità (High Availability)**, altamente scalabile e progettato secondo i principi di **Zero Trust** e del **minimo privilegio** del framework *AWS Well-Architected*.

---

## Architettura dell'Infrastruttura

L'intera rete è racchiusa all'interno di una **VPC** dedicata (`10.0.0.0/16`) ridondata su due Zone di Disponibilità (*eu-north-1a* e *eu-north-1b*):

### 1. Presentation Tier (Subnet Pubbliche)
* **Application Load Balancer (ALB)** per l'accettazione e il bilanciamento del traffico web in ingresso (HTTP/HTTPS).
* **NAT Gateway** per consentire alle risorse private di uscire su Internet in modo sicuro (solo outbound per aggiornamenti).

### 2. Application Tier (Subnet Private)
* Server web/applicativi **Amazon EC2** privi di IP pubblici.
* Gestione della scalabilità e della ridondanza tramite **Auto Scaling Group (ASG)** legato al bilanciatore di carico.

### 3. Data Tier (Subnet Isolate)
* Database gestito **Amazon RDS (MySQL)** completamente isolato, senza accesso da/verso Internet.

---

## Sicurezza e Controllo degli Accessi

### Firewall Virtuali a Catena Chiusa (Security Groups)
* L'ALB accetta traffico da Internet.
* I server EC2 accettano traffico **esclusivamente dall'ALB**.
* Il Database RDS accetta traffico **esclusivamente dai server EC2**.

### Accesso Amministrativo Senza SSH
Raggiungibilità e manutenzione delle macchine private gestite in modo cifrato via **AWS Systems Manager (SSM) Session Manager**, eliminando la necessità di aprire la porta SSH (22) o di configurare Bastion Host.

---

## Verifica e Risultati

* **Bilanciamento Attivo**: Test sul DNS pubblico dell'ALB confermano il corretto instradamento e il failover automatico del traffico tra le due Availability Zone.
* **Isolamento Rete**: Verificata l'inaccessibilità diretta da Internet per i server applicativi e il database.

    

