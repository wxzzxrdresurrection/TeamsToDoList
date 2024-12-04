export default function FormInput({ placeholder, type, setter, name }) {
    return (
        <>
            <input
                className="bg-zinc-800 rounded-lg my-1 py-3 px-2 text-sm w-full"
                type={type ?? "text"}
                placeholder={placeholder}
                onChange={(e) => setter(e.target.value)}
                name={name ?? placeholder}
            />
        </>
    );
}
