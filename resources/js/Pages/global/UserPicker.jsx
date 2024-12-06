import { useEffect, useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUser } from "@fortawesome/free-regular-svg-icons";

export default function UserPicker({ selectedUser, setSelectedUser }) {
    const [users, setUsers] = useState([]);

    useEffect(() => {
        const teamId = window.location.pathname.split("/")[3];
        fetch(`/api/teams/users/${teamId}`,
            {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${localStorage.getItem("token")}`,
                }
            }
        )
            .then((response) => response.json())
            .then((json) => {
                setUsers(json.data);
            });
    }, []);

    return (
        <>
            <div className="flex flex-col space-y-2 pb-6 overflow-y-scroll max-h-60 border-b">
                <div
                    className={`flex items-center space-x-3 border-white rounded-xl p-4 ${
                        selectedUser == null ? "border-4" : ""
                    }`}
                    onClick={() => {
                        setSelectedUser(null);
                    }}
                    key={0}
                >
                    <div className="bg-white w-10 h-10 rounded-full" />
                    <p>Ninguno</p>
                </div>
                {users.map((user) => (
                    <div
                        key={user.id}
                        className={`flex items-center space-x-3 p-4 rounded-lg border-white ${
                            selectedUser == user.id ? "border-4" : ""
                        }`}
                        onClick={() => {
                            setSelectedUser(user.id);
                        }}
                    >
                        <FontAwesomeIcon icon={faUser} className="w-10 h-10" />
                        <p>{user.username}</p>
                    </div>
                ))}
            </div>
        </>
    );
}
