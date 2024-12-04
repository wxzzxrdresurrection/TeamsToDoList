<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\RandomCharacterGenerator;
use App\Models\Team;
use App\Validators\RequestValidator;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function findTeamsByUser(Request $request)
    {
        $teams = $request->user()->teams;
        return ApiResponse::success('Equipos encontrados correctamente', $teams, null, 200);
    }

    public function findOne(int $id)
    {
        $team = Team::find($id);

        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        return ApiResponse::success('Equipo encontrado correctamente', $team, null, 200);
    }

    public function getUsersByTeam(int $id)
    {
        $team = Team::find($id);

        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        $users = $team->users;
        return ApiResponse::success('Usuarios encontrados correctamente', $users, null, 200);
    }

    public function create(Request $request)
    {
        $validator = RequestValidator::validateTeamRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        do {
            $teamCode = RandomCharacterGenerator::generate(7, true, true, true, false);
            $codeExists = Team::where(Team::CODE, $teamCode)->exists();
        } while ($codeExists);
        $userId = $request->user()->id;

        $team = Team::create([
            Team::NAME => $request->name,
            Team::OWNER_ID => $userId,
            Team::DESCRIPTION => $request->description,
            Team::CODE => $teamCode,
            Team::ICON => $request->icon
        ]);

        $team->users()->attach($userId);

        return ApiResponse::success('Equipo creado correctamente', $team, null, 201);
    }

    public function update(Request $request, int $id)
    {
        $validator = RequestValidator::validateTeamRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $team = Team::find($id);
        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        Team::where('id', $id)->update([
            Team::NAME => $request->name,
            Team::DESCRIPTION => $request->description,
            Team::ICON => $request->icon
        ]);

        return ApiResponse::success('Equipo actualizado correctamente', $team, null, 200);
    }

    public function joinTeamByCode(Request $request)
    {
        $validator = RequestValidator::validateTeamCodeRequest($request);

        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $team = Team::where(Team::CODE, $request->code)->first();
        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        $userId = $request->user()->id;
        $isMember = $team->users()->where('user_id', $userId)->exists();

        if ($isMember)
        {
            return ApiResponse::error('Ya eres miembro de este equipo', null, 409);
        }

        $team->users()->attach($userId);
        return ApiResponse::success('Te has unido al equipo correctamente', $team, null, 200);
    }

    public function addUserToTeam(Request $request, int $id)
    {
        $validator = RequestValidator::validateUserId($request);
        if (!$validator->isEmpty())
        {
            return ApiResponse::error('Errores de validación', $validator->messages(), 422);
        }

        $team = Team::find($id);
        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        $isMember = $team->users()->where('user_id', $request->user_id)->exists();

        if ($isMember)
        {
            return ApiResponse::error('El usuario ya es miembro de este equipo', null, 409);
        }

        $team->users()->attach($request->user_id);
        return ApiResponse::success('Usuario añadido al equipo correctamente', $team, null, 200);
    }

    public function removeUserFromTeam(int $teamId, int $userId)
    {
        $team = Team::find($teamId);
        if (!$team)
        {
            return ApiResponse::error('Equipo no encontrado', null, 404);
        }

        if ($team->owner_id === $userId)
        {
            return ApiResponse::error('El propietario del equipo no puede eliminarse', null, 409);
        }

        $isMember = $team->users()->where('user_id', $userId)->exists();

        if (!$isMember)
        {
            return ApiResponse::error('El usuario no es miembro de este equipo', null, 409);
        }

        $team->users()->detach($userId);
        return ApiResponse::success('Usuario eliminado del equipo correctamente', $team, null, 200);
    }
}
