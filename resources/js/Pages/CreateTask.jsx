import AlternativeButton from "./global/AlternativeButton";
import FormInput from "./global/FormInput";
import PrimaryButton from "./global/PrimaryButton";
import UserPicker from "./global/UserPicker";

export default function CreateTask() {
    return (
        <div className="container mx-auto my-auto">
            <h1 className="grid justify-center my-8">Crear tarea</h1>
                <div className="flex flex-col mx-4 mb-4 space-y-4">
                    <FormInput placeholder="Nombre de la tarea" />
                    <FormInput placeholder="Descripción" />
                    <FormInput placeholder="Fecha de entrega" />
                    <h2 className="text-2xl py-5">Asignar tarea</h2>
                    <UserPicker />
                    <PrimaryButton text="Crear tarea"/>
                    <AlternativeButton text="Cancelar"/>
                </div>
        </div>
    )
}
