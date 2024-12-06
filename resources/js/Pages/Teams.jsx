import { useEffect, useState } from "react";

export default function Teams() {
    const [teams, setTeams] = useState([]);

    function myTeamsRequest() {
        fetch("/api/teams", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        })
            .then((response) => response.json())
            .then((data) => setTeams(data.data))
            .catch((error) => console.log(error));
    }

    function navigateToCreateTeam() {
        window.location.href = "/join/team";
    }

    const navigateToTeam = (teamId) => {
        window.location.href = `/team/${teamId}`;
    }

    useEffect(() => {
        myTeamsRequest();
    }, []);

    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8 text-lg">Equipos</h1>
            <div className="flex flex-col mx-4">
                <p className="text-md mb-4">Mis equipos</p>
                <div className="flex flex-col">
                    {teams.map((team) => (
                        <div
                            key={team.id}
                            className="border-b border-zinc-700 w-full py-3 hover:cursor-pointer"
                            onClick={() => navigateToTeam(team.id)}
                        >
                            <p className="text-md">{team.name}</p>
                            <p className="text-md text-zinc-400">
                                {team.description}
                            </p>
                        </div>
                    ))}
                </div>
            </div>
            <div className="fixed bottom-2 right-1" onClick={() => navigateToCreateTeam()}>
                <button className="bg-zinc-700 rounded-full w-14 h-14 grid justify-center items-center text-5xl pb-2">
                    +
                </button>
            </div>
        </div>
    );
}
