import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faList } from "@fortawesome/free-solid-svg-icons";
import { faGear } from "@fortawesome/free-solid-svg-icons";
import { faIcons } from "@fortawesome/free-solid-svg-icons";

export default function Navbar(){

    const icons = [
        {id: 1, name: "Tasks", icon: faIcons},
        {id: 2, name: "All tasks", icon: faList},
        {id: 3, name: "Settings", icon: faGear}
    ]

    return (
        <div className="w-full flex">
            {icons.map((icon) => (
                <div key={icon.id} className="w-1/3 text-center flex flex-col">
                    <FontAwesomeIcon icon={icon.icon} className="text-white h-6"/>
                    <a href="" className="text-white text-sm">{icon.name}</a>
                </div>
            ))}
        </div>
    )
}
