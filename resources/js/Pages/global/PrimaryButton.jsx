export default function PrimaryButton({ text, action }) {
    return (
        <>
            <button
                className="bg-white text-black py-2 rounded-full hover:cursor-pointer"
                onClick={action}
            >
                {text}
            </button>
        </>
    );
}
