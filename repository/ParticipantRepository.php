<?php
class ParticipantRepository extends Repository
{
    public function getParticipants() {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = $row;
        }
        return $results;
    }

    public function getParticipant($participantId) {
        $sql = "SELECT p.participantId, p.scoutName, p.preName, p.name, p.branch
            FROM participant p
            WHERE p.participantId = :participantId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('participantId', $participantId);
        $stmt->execute();
        
        $row = $stmt->fetch();
        return $row;
    }
    /**
     * Get one ticket by its ID
     *
     * @param int $ticket_id The ID of the ticket
     * @return TicketEntity  The ticket
     */
   /* public function getTicketById($ticket_id) {
        $sql = "SELECT t.id, t.title, t.description, c.component
            from tickets t
            join components c on (c.id = t.component_id)
            where t.id = :ticket_id";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(["ticket_id" => $ticket_id]);
        if($result) {
            return new TicketEntity($stmt->fetch());
        }
    }
    public function save(TicketEntity $ticket) {
        $sql = "insert into tickets
            (title, description, component_id) values
            (:title, :description, 
            (select id from components where component = :component))";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "title" => $ticket->getTitle(),
            "description" => $ticket->getDescription(),
            "component" => $ticket->getComponent(),
        ]);
        if(!$result) {
            throw new Exception("could not save record");
        }
    }*/
}
