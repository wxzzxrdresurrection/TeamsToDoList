export default function AlternativeButton({ text, action }) {
    return (
        <>
            <button
                className="bg-black text-white border-white border py-2 rounded-full hover:cursor-pointer"
                onClick={action}
            >
                {text}
            </button>
        </>
    );
}
