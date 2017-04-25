<?php

namespace Noldors\CommerceMLParser\Models\ComplexTypes;

use Noldors\Collections\Collection;

/**
 * Абстрактный класс для контрагентов, представителей. Пока только для юр. лиц.
 *
 * @package Noldors\CommerceMLParser\Models\ComplexTypes
 */
abstract class Contractor
{
    /**
     * Xml id.
     *
     * @var string
     */
    protected $id;

    /**
     * Наименование владельца.
     *
     * @var string
     */
    protected $name;

    /**
     * Официальное наименование.
     *
     * @var string
     */
    protected $officialName;

    /**
     * Юридический адрес.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    protected $legalAddress;

    /**
     * Инн.
     *
     * @var string
     */
    protected $inn;

    /**
     * КПП.
     *
     * @var string
     */
    protected $kpp;

    /**
     * Основной вид деятельности.
     *
     * @var string
     */
    protected $mainActivity;

    /**
     * ЕГРПО.
     *
     * @var string
     */
    protected $egrpo;

    /**
     * ОКВЭД.
     *
     * @var string
     */
    protected $okved;

    /**
     * ОКДП.
     *
     * @var string
     */
    protected $okdp;

    /**
     * ОКОПФ.
     *
     * @var string
     */
    protected $okopf;

    /**
     * ОКФС.
     *
     * @var string
     */
    protected $okfs;

    /**
     * ОКПО.
     *
     * @var string
     */
    protected $okpo;

    /**
     * Дата Регистрации.
     *
     * @var \DateTime
     */
    protected $dateRegister;

    /**
     * Руководитель.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Chief
     */
    protected $chief;

    /**
     * Расчетные счета.
     *
     * @var \Noldors\Collections\Collection
     */
    protected $settlementAccounts;

    /**
     * Комментарий.
     *
     * @var string
     */
    protected $comment;

    /**
     * Адрес.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    protected $address;

    /**
     * Контакты.
     *
     * @var \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    protected $contacts;

    /**
     * Constructor.
     *
     * @param \SimpleXMLElement|null $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (is_null($xml)) {
            return;
        }

        $this->id = (string)$xml->Ид;
        $this->name = (string)$xml->Наименование;
        $this->officialName = (string)$xml->ОфициальноеНаименование;
        if ($xml->ЮридическийАдрес) {
            $this->legalAddress = new Address($xml->ЮридическийАдрес);
        }
        $this->inn = (string)$xml->ИНН;
        $this->kpp = (string)$xml->КПП;
        $this->mainActivity = (string)$xml->ОсновнойВидДеятельности;
        $this->egrpo = (string)$xml->ЕГРПО;
        $this->okved = (string)$xml->ОКВЭД;
        $this->okdp = (string)$xml->ОКДП;
        $this->okopf = (string)$xml->ОКОПФ;
        $this->okfs = (string)$xml->ОКФС;
        $this->okpo = (string)$xml->ОКПО;
        if ($xml->ДатаРегистрации) {
            $this->dateRegister = \DateTime::createFromFormat('Y-m-d\TH:i:s', (string)$xml->ДатаРегистрации);
        }
        if ($xml->Руководитель) {
            $this->chief = new Chief($xml->Руководитель);
        }
        if ($xml->РасчетныеСчета) {
            $this->settlementAccounts = new Collection();

            foreach ($xml->РасчетныеСчета->РасчетныйСчет as $account) {
                $this->settlementAccounts->push(new SettlementAccount($account));
            }
        }

        $this->comment = (string)$xml->Комментарий;
        if ($xml->Адрес) {
            $this->address = new Address($xml->Адрес);
        }
        if ($xml->Контакты) {
            $this->contacts = new Contact($xml->Контакты);
        }
    }

    /**
     * Получить xml id.
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Получить наименование.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Получить официальное наименование.
     *
     * @return string
     */
    public function getOfficialName()
    {
        return $this->officialName;
    }

    /**
     * Получить юридический адрес.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    public function getLegalAddress()
    {
        return $this->legalAddress;
    }

    /**
     * Получить ИНН.
     *
     * @return string
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Получить КПП.
     *
     * @return string
     */
    public function getKpp()
    {
        return $this->kpp;
    }

    /**
     * Получить основной вид деятельности.
     *
     * @return string
     */
    public function getMainActivity()
    {
        return $this->mainActivity;
    }

    /**
     * Получить ЕГРПО.
     *
     * @return string
     */
    public function getEgrpo()
    {
        return $this->egrpo;
    }

    /**
     * Получить ОКВЕД.
     *
     * @return string
     */
    public function getOkved()
    {
        return $this->okved;
    }

    /**
     * Получить ОКДП.
     * @return string
     */
    public function getOkdp()
    {
        return $this->okdp;
    }

    /**
     * Получить ОКОПФ.
     *
     * @return string
     */
    public function getOkopf()
    {
        return $this->okopf;
    }

    /**
     * Получить ОКФС.
     *
     * @return string
     */
    public function getOkfs()
    {
        return $this->okfs;
    }

    /**
     * Получить ОКПО.
     *
     * @return string
     */
    public function getOkpo()
    {
        return $this->okpo;
    }

    /**
     * Получить дату регистрации.
     *
     * @return \DateTime
     */
    public function getDateRegister()
    {
        return $this->dateRegister;
    }

    /**
     * Получить руководителя.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Chief
     */
    public function getChief()
    {
        return $this->chief;
    }

    /**
     * Получить расчетные счета.
     *
     * @return \Noldors\Collections\Collection
     */
    public function getSettlementAccounts()
    {
        return $this->settlementAccounts;
    }

    /**
     * Получить комментарий.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Получить адрес.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Получить контакты.
     *
     * @return \Noldors\CommerceMLParser\Models\ComplexTypes\Contact
     */
    public function getContacts()
    {
        return $this->contacts;
    }
}