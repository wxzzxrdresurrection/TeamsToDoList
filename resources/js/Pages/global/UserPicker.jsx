import { useEffect, useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUser } from "@fortawesome/free-regular-svg-icons";

export default function UserPicker() {
    const [users, setUsers] = useState([]);
    const [selectedUser, setSelectedUser] = useState(null);
    useEffect(() => {
        fetch("/api/users")
            .then((response) => response.json())
            .then((json) => {
                //setUsers(json.data);
                setUsers(fakeUsers);
            });
    }, []);

    const fakeUsers = [
        { id: 1, username: "Juan" },
        { id: 2, username: "Pedro" },
        { id: 3, username: "Pablo" },
        { id: 4, username: "José" },
        { id: 5, username: "María" },
        { id: 6, username: "Ana" },
        { id: 7, username: "Luis" },
        { id: 8, username: "Miguel" },
        { id: 9, username: "Rosa" },
        { id: 10, username: "Elena"}
    ];

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
