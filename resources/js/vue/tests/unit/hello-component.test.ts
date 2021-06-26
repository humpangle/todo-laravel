import HelloWorld from "@/components/HelloWorld.vue";
import { render } from "@testing-library/vue";
import { duplicateMsgId, msgId } from "@/components/hello-word";
import userEvent from "@testing-library/user-event";

describe("HelloWorld.vue", () => {
  it("renders props.msg when passed", async () => {
    const msg = "new message";
    const { debug } = render(HelloWorld, {
      props: { msg },
    });

    const msgEl = getById(msgId);
    expect(msgEl.textContent).toEqual(msg);

    const doubleMsgEl = getById(duplicateMsgId);
    await userEvent.click(doubleMsgEl);
    expect(msgEl.textContent).toEqual(`${msg}-${msg}`);
  });
});

function getById(id: string) {
  return document.getElementById(id) as HTMLElement;
}
