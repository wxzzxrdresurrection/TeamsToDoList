import { useEffect, useState } from 'react';

export default function Teams(){
    const [teams, setTeams] = useState([]);

    function myTeamsRequest(){
        fetch('/api/teams',
            {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    //TODO: Change this token to the one you got from the login
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }
        ).then(response => response.json())
        .then(data => setTeams(data.data))
        .catch(error => console.log(error));
    }

    useEffect(() => {myTeamsRequest()}, []);

    return (
        <div className="container mx-auto my-auto">
        <h1 className="grid justify-center my-8 text-lg">Equipos</h1>
            <div className="flex flex-col mx-4">
                <p className="text-md mb-4">Mis equipos</p>
                <div className="flex flex-col">
                    {teams.map( team => (
                        <div key={team.id} className="border-b border-zinc-700 w-full py-3 hover:cursor-pointer">
                            <p className="text-md">{team.name}</p>
                            <p className="text-md text-zinc-400">{team.description}</p>
                        </div>
                    ))}
                </div>
            </div>
    </div>
    )
}
