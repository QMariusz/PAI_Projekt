<?php
/**
 * Created by PhpStorm.
 * User: Mariusz
 * Date: 30.12.2018
 * Time: 20:59
 */

class Question implements JsonSerializable
{
    private $id;
    private $authorId;
    private $name;
    private $answers;
    private $votes;
    private $addDate;
    private $modifyDate;

    public function __construct($id, $authorId, $name, $answers, $votes, $addDate, $modifyDate)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->name = $name;
        $this->answers = $answers;
        $this->votes = $votes;
        $this->addDate = $addDate;
        $this->modifyDate = $modifyDate;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'authorId' => $this->authorId,
            'qName' => $this->name,
            'answers' => $this->answers,
            'votes' => $this->votes,
            'addDate' => $this->addDate,
            'modifyDate' => $this->modifyDate
        ];
    }

    /**
     * @return mixed
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * @param mixed $addDate
     */
    public function setAddDate($addDate): void
    {
        $this->addDate = $addDate;
    }

    /**
     * @return mixed
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
    }

    /**
     * @param mixed $modifyDate
     */
    public function setModifyDate($modifyDate): void
    {
        $this->modifyDate = $modifyDate;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param mixed $answers
     */
    public function setAnswers($answers): void
    {
        $this->answers = $answers;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * @param mixed $votes
     */
    public function setVotes($votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }



}