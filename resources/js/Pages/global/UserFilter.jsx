import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUser } from "@fortawesome/free-regular-svg-icons";

export default function UserFilter({ users, selectedUser, setSelectedUser }) {
  return (
    <div className="w-full">
      <div className="overflow-x-auto flex mx-2">
        { !selectedUser ? users.map((user) => (
          <div
            className="bg-zinc-700 rounded-full flex items-center justify-center py-1 px-4 mx-1"
            key={user.id}
            onClick={() => setSelectedUser(user)}
          >
            <p className="text-white">{user.username}</p>
            <FontAwesomeIcon icon={faUser} className="ml-2 text-white" />
          </div>
        )):
        <div
            className="bg-zinc-700 rounded-full flex items-center justify-center py-1 px-4 mx-1"
            key={selectedUser.id}
            onClick={() => setSelectedUser(null)}
          >
            <p className="text-white">{selectedUser.username}</p>
            <FontAwesomeIcon icon={faUser} className="ml-2 text-white" />
          </div>}
      </div>
    </div>
  );
}
