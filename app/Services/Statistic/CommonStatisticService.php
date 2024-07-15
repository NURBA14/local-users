<?php

namespace App\Services\Statistic;

use App\Base\ServiceBase\Enums\HttpMethods;
use App\Base\ServiceBase\ServiceBase;
use App\Enums\Users\Accounts\AccountStatus;
use App\Enums\Users\Accounts\ConfirmedStatus;
use App\Enums\Users\Accounts\IinStatus;
use App\Enums\Users\Profiles\ProfileStatus;
use App\Models\Users\Gender;
use App\Models\Users\Nationality;
use Illuminate\Support\Facades\DB;

class CommonStatisticService extends ServiceBase
{
    protected const METHOD = HttpMethods::GET;
    protected function handleLogic()
    {
        $data = [
            "account" => $this->accountStatistic(),
            "profile" => $this->profileStatistic(),
            "gender" => $this->genderStatistic(),
            "nationality" => $this->nationlityStatistic()
        ];
        return $this->responder()->success(__("Common statistic"), [], $data, 200);
    }
    public function validateRules(): array
    {
        return [];
    }

    private function accountStatistic()
    {
        $data = [
            "totalAccounts" => DB::table("user_accounts")->count(),
            "deletedAccountsCount" => DB::table("user_accounts")->where("status", "=", AccountStatus::DELETED->value)->count(),
            "blockedAccountsCount" => DB::table("user_accounts")->where("status", "=", AccountStatus::BLOCKED->value)->count(),
            "inActiveAccountsCount" => DB::table("user_accounts")->where("status", "=", AccountStatus::INACTIVE->value)->count(),
            "activeAccountsCount" => DB::table("user_accounts")->where("status", "=", AccountStatus::ACTIVE->value)->count(),
            "confirmedPhoneAccountsCount" => DB::table("user_accounts")->where("phone_status", "=", ConfirmedStatus::TRUE->value)->count(),
            "notConfirmedPhoneAccountsCount" => DB::table("user_accounts")->where("phone_status", "=", ConfirmedStatus::FALSE->value)->count(),
            "accountsPhonesCount" => DB::table("user_accounts")->whereNotNull("phone")->count(),
            "confirmedEmailAccountsCount" => DB::table("user_accounts")->where("email_status", "=", ConfirmedStatus::TRUE->value)->count(),
            "notConfirmedEmailAccountsCount" => DB::table("user_accounts")->where("email_status", "=", ConfirmedStatus::FALSE->value)->count(),
            "accountsEmailCount" => DB::table("user_accounts")->whereNotNull("email")->count(),
            "accountsLoginCount" => DB::table("user_accounts")->whereNotNull("login")->count(),
            "iinNotNullAccountsCount" => DB::table("user_accounts")->whereNotNull("iin")->count(),
            "iinNullAccountsCount" => DB::table("user_accounts")->whereNull("iin")->count(),
            "iinConfirmedWithEcpAccountsCount" => DB::table("user_accounts")->where("iin_status", "=", IinStatus::ECP->value)->count(),
            "iinConfirmedWithAdminAccountsCount" => DB::table("user_accounts")->where("iin_status", "=", IinStatus::ADMIN->value)->count(),
            "iinConfirmedWithMedianaAccountsCount" => DB::table("user_accounts")->where("iin_status", "=", IinStatus::MEDIANA->value)->count(),
            "iinConfirmedWithGBDFLAccountsCount" => DB::table("user_accounts")->where("iin_status", "=", IinStatus::GBDFL->value)->count(),
        ];
        return $data;
    }

    private function profileStatistic()
    {
        $data = [
            "totalProfiles" => DB::table("user_profiles")->count(),
            "iinProfilesCount" => DB::table("user_profiles")->whereNotNull("iin")->count(),
            "nicknameProfilesCount" => DB::table("user_profiles")->whereNotNull("nickname")->count(),
            "nameProfilesCount" => DB::table("user_profiles")->whereNotNull("name")->count(),
            "surnameProfilesCount" => DB::table("user_profiles")->whereNotNull("surname")->count(),
            "lastnameProfilesCount" => DB::table("user_profiles")->whereNotNull("lastname")->count(),
            "birthdateProfilesCount" => DB::table("user_profiles")->whereNotNull("birthdate")->count(),
            "deathdateProfilesCount" => DB::table("user_profiles")->whereNotNull("deathdate")->count(),
            "genderProfilesCount" => DB::table("user_profiles")->whereNotNull("gender_id")->count(),
            "nationalityProfilesCount" => DB::table("user_profiles")->whereNotNull("nationality_id")->count(),
            "residentProfilesCount" => DB::table("user_profiles")->whereNotNull("resident")->count(),
            "fatherProfilesCount" => DB::table("user_profiles")->whereNotNull("father_iin")->count(),
            "motherProfilesCount" => DB::table("user_profiles")->whereNotNull("mother_iin")->count(),
            "guardianProfilesCount" => DB::table("user_profiles")->whereNotNull("guardian_iin")->count(),
            "statusIsEmptyProfilesCount" => DB::table("user_profiles")->where("status", "=", ProfileStatus::EMPTY )->count(),
            "statusIsFilledProfilesCount" => DB::table("user_profiles")->where("status", "=", ProfileStatus::FILLED)->count(),
            "statusIsConfirmedProfilesCount" => DB::table("user_profiles")->where("status", "=", ProfileStatus::CONFIRMED)->count(),
        ];
        return $data;
    }

    private function genderStatistic()
    {

        $data = [
            "gendersCount" => Gender::count(),
        ];
        $genders = Gender::withCount("profiles")->get();
        foreach ($genders as $gender) {
            $data[$gender->name] = $gender->profiles_count ?? 0;
        }
        return $data;
    }

    private function nationlityStatistic()
    {
        $data = [
            "nationlitiesCount" => Nationality::count(),
        ];
        return $data;
    }

}